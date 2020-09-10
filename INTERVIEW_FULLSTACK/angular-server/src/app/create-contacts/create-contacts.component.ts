import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {Contact, ContactsService, Email} from "../contacts.service";
import {Router} from "@angular/router";
import {AlertService} from "../shared/services/alert.service";


@Component({
  selector: 'app-create-contacts',
  templateUrl: './create-contacts.component.html',
  styleUrls: ['./create-contacts.component.scss']
})
export class CreateContactsComponent implements OnInit {
  addForm: FormGroup;
  contact: Contact
  contacts: Contact[]
  emails: Email[]
  emIN
  unique:boolean = false


  constructor(private contactsService: ContactsService,
              private router: Router,
              private alert: AlertService
  ) {
  }

  ngOnInit() {
    this.contactsService.getAllEm().subscribe(e => {
      this.emails = e
    })

    this.addForm = new FormGroup({
      first_name: new FormControl('', [Validators.required, this.noWhitespaceValidator, Validators.pattern('[a-zA-z]*')]),
      last_name: new FormControl('', [Validators.required, this.noWhitespaceValidator, Validators.pattern('[a-zA-z]*')]),
      email: new FormControl('', [Validators.required, Validators.email, this.noWhitespaceValidator]),
      company_name: new FormControl('', [Validators.required, this.noWhitespaceValidator]),
      job_title: new FormControl('', [Validators.required, this.noWhitespaceValidator]),
      age: new FormControl('', [Validators.required, Validators.maxLength(3), Validators.min(8), Validators.max(120)])
    })
  }


  checkEmail() {
    console.log(this.emails)
    if (this.emails){
      if (this.emails.some(em=>em.email==this.emIN)) {
        this.unique = false
      } else {
        this.unique = true
      }
    }
  }


  submit() {
    if (this.addForm.invalid) {
      return
    }
    const formData = {...this.addForm.value}
    this.contactsService.add(formData).subscribe(() => {
        this.addForm.reset()
        this.alert.success('Пост был создан')
      }
    )
  }

  public noWhitespaceValidator(control: FormControl) {
    const isWhitespace = (control.value || '').trim().length === 0;
    const isValid = !isWhitespace;
    return isValid ? null : {'whitespace': true};
  }
}
