import { Component, OnInit } from '@angular/core';
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {Router} from "@angular/router";
import {User, UserService} from "../user.service";
import {Email} from "../user.service";
import {AlertService} from "../shared/services/alert.service";

@Component({
  selector: 'app-profile-page',
  templateUrl: './profile-page.component.html',
  styleUrls: ['./profile-page.component.scss']
})
export class ProfilePageComponent implements OnInit {
  proForm:FormGroup
  emails: Email[]
  user:User
  constructor(private router: Router,
              private usersService:UserService,
              private alert: AlertService
              ) { }

  ngOnInit() {
    this.usersService.getAllEm().subscribe(e => {
      this.emails = e
    })

    this.proForm = new FormGroup({
      first_name: new FormControl('', [Validators.required, this.noWhitespaceValidator, Validators.pattern('[a-zA-z]*')]),
      last_name: new FormControl('', [Validators.required, this.noWhitespaceValidator, Validators.pattern('[a-zA-z]*')]),
      email: new FormControl('', [Validators.required, Validators.email, this.noWhitespaceValidator]),
      password: new FormControl('', [Validators.required, this.noWhitespaceValidator]),
      password2: new FormControl('', [Validators.required, this.noWhitespaceValidator]),
      age: new FormControl('', [Validators.required, Validators.maxLength(3), Validators.min(8), Validators.max(120)])
    })
  }

  submit() {
    if (this.proForm.invalid) {
      return
    }
    const formData = {...this.proForm.value}
    this.usersService.update(formData,this.user.id).subscribe(() => {
        this.proForm.reset()
        this.alert.success('User data edited')
      }
    )
  }

  public noWhitespaceValidator(control: FormControl) {
    const isWhitespace = (control.value || '').trim().length === 0;
    const isValid = !isWhitespace;
    return isValid ? null : {'whitespace': true};
  }
}
