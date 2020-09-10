import { Component, OnInit } from '@angular/core';
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {ContactsService, Email} from "../contacts.service";
import {Router} from "@angular/router";
import {AlertService} from "../shared/services/alert.service";
import {UserService} from "../user.service";

@Component({
  selector: 'app-register-page',
  templateUrl: './register-page.component.html',
  styleUrls: ['./register-page.component.scss']
})
export class RegisterPageComponent implements OnInit {
  regForm:FormGroup
  emails: Email[]
  constructor(private userService:UserService,
              private router: Router,
              private alert: AlertService) { }

  ngOnInit() {
    /*this.contactsService.getAllEm().subscribe(e => {
      this.emails = e
    })*/

    this.regForm = new FormGroup({
      first_name: new FormControl('', [Validators.required, this.noWhitespaceValidator, Validators.pattern('[a-zA-z]*')]),
      last_name: new FormControl('', [Validators.required, this.noWhitespaceValidator, Validators.pattern('[a-zA-z]*')]),
      email: new FormControl('', [Validators.required, Validators.email, this.noWhitespaceValidator]),
      password: new FormControl('', [Validators.required, this.noWhitespaceValidator]),
      age: new FormControl('', [Validators.required, Validators.maxLength(3), Validators.min(8), Validators.max(120)])
    })
  }

  submit() {
    if (this.regForm.invalid) {
      return
    }
    const formData = {...this.regForm.value}
    this.userService.register(formData).subscribe(() => {
        this.regForm.reset()
        this.alert.success('Registered')
      }
    )
  }

  public noWhitespaceValidator(control: FormControl) {
    const isWhitespace = (control.value || '').trim().length === 0;
    const isValid = !isWhitespace;
    return isValid ? null : {'whitespace': true};
  }
}
