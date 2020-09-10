import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {Router} from "@angular/router";
import {AlertService} from "../shared/services/alert.service";
import {User, UserService} from "../user.service";

@Component({
  selector: 'app-login-page',
  templateUrl: './login-page.component.html',
  styleUrls: ['./login-page.component.scss']
})
export class LoginPageComponent implements OnInit {

  form:FormGroup
  user:User

  constructor( private userService:UserService,
               private router: Router,
               private alert: AlertService) {
  }

  ngOnInit() {
    this.form = new FormGroup({
      email: new FormControl(null,[Validators.required,Validators.email]),
      password: new FormControl(null,[Validators.required,Validators.minLength(6)])
    })
  }

  /*checkEmail() {
    console.log(this.emails)
    if (this.emails.some(em=>em.email==this.emIN)) {
      this.unique = false
    } else {
      this.unique = true
    }
  }*/


  onSubmit() {
    if (this.form.invalid) {
      return
    }
    const formData = {...this.form.value}
    this.userService.login(formData).subscribe(() => {
        this.form.reset()
        this.alert.success('Logged')
        this.router.navigate(['contacts']);
      }
    )
  }

  public noWhitespaceValidator(control: FormControl) {
    const isWhitespace = (control.value || '').trim().length === 0;
    const isValid = !isWhitespace;
    return isValid ? null : {'whitespace': true};
  }
}
