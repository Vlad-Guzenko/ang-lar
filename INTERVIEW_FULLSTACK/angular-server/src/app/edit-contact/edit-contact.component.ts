import {Component, OnDestroy, OnInit} from '@angular/core';
import {Contact, ContactsService, Email} from "../contacts.service";
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {ActivatedRoute, Params} from "@angular/router";
import {switchMap} from "rxjs/operators";
import {Subscription} from "rxjs";
import {AlertService} from "../shared/services/alert.service";

@Component({
  selector: 'app-edit-contact',
  templateUrl: './edit-contact.component.html',
  styleUrls: ['./edit-contact.component.scss']
})
export class EditContactComponent implements OnInit ,OnDestroy{

  editForm: FormGroup
  contact:Contact
  submitted = false
  emails: Email[]
  emIN
  unique:boolean = false

  uSub: Subscription

  constructor(private contactsService: ContactsService,
              private route: ActivatedRoute,
              private alert: AlertService) {
  }

  ngOnInit() {
    this.contactsService.getAllEm().subscribe(e => {
      this.emails = e
    })
      this.route.params.pipe(
        switchMap((params: Params) => {
          return this.contactsService.getById(params['id'])
        })
      ).subscribe((contact: Contact) => {
        this.contact = contact
        this.editForm = new FormGroup({
          first_name:new FormControl(contact.first_name,[Validators.required,Validators.pattern('[a-zA-z]*')]),
          last_name:new FormControl(contact.last_name,[Validators.required,Validators.pattern('[a-zA-z]*')]),
          email:new FormControl(contact.email,[Validators.required,Validators.email]),
          company_name:new FormControl(contact.company_name,[Validators.required]),
          job_title:new FormControl(contact.job_title,[Validators.required]),
          age:new FormControl(contact.age,[Validators.required,Validators.maxLength(3),Validators.min(8), Validators.max(120)])
        })
      })
  }

  checkEmail(contactEm:Contact) {
    console.log(this.emails)
    console.log(contactEm.email)
    if (this.emails.some(em=>em.email==this.emIN)) {
      this.unique = false
    } else{
      this.unique = true
    }
  }

  ngOnDestroy() {
    if (this.uSub) {
      this.uSub.unsubscribe()
    }
  }

  submit() {
    this.editForm.disable()
    if (this.editForm.invalid) {
      return
    }

    this.submitted = true

    this.uSub = this.contactsService.update({
      ...this.contact,
      first_name: this.editForm.value.first_name,
      last_name: this.editForm.value.last_name,
      email:this.editForm.value.email,
      company_name: this.editForm.value.company_name,
      job_title: this.editForm.value.job_title,
      age: this.editForm.value.age
    },this.contact.id).subscribe(() => {
      this.submitted = false
      this.alert.success('Updated')
      this.editForm.enable()
    })
  }

  public noWhitespaceValidator(control: FormControl) {
    const isWhitespace = (control.value || '').trim().length === 0;
    const isValid = !isWhitespace;
    return isValid ? null : { 'whitespace': true };
  }
}
