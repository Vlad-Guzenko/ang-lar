import {BrowserModule} from '@angular/platform-browser';
import {NgModule, Provider} from '@angular/core';
import {EmailValidator, FormsModule, ReactiveFormsModule} from '@angular/forms';
import {AppRoutingModule} from "./app-routing.module";
import {HTTP_INTERCEPTORS, HttpClientModule} from '@angular/common/http';


import {AppComponent} from './app.component';
import {ContactsComponent} from './contacts/contacts.component';
import {CreateContactsComponent} from './create-contacts/create-contacts.component';
import {LoginPageComponent} from './login-page/login-page.component';
import {AuthLayoutComponent} from './shared/layouts/auth-layout/auth-layout.component';
import {SiteLayoutComponent} from './shared/layouts/site-layout/site-layout.component';
import {RegisterPageComponent} from './register-page/register-page.component';
import { EditContactComponent } from './edit-contact/edit-contact.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { AlertComponent } from './shared/components/alert/alert.component';
import {AlertService} from "./shared/services/alert.service";
import {SearchPipe} from "./shared/search.pipe";
import { EmailPageComponent } from './email-page/email-page.component';
import { ProfilePageComponent } from './profile-page/profile-page.component';
import {AuthGuard} from "./auth.guard";
import {TokenInterceptor} from "./token.interceptor";

/*const INTERCEPTOR_PROVIDER: Provider = {
  provide: HTTP_INTERCEPTORS,
  useClass: AuthInterceptor,
  multi: true
}*/

@NgModule({
  declarations: [
    AppComponent,
    ContactsComponent,
    CreateContactsComponent,
    LoginPageComponent,
    AuthLayoutComponent,
    SiteLayoutComponent,
    RegisterPageComponent,
    EditContactComponent,
    AlertComponent,
    SearchPipe,
    EmailPageComponent,
    ProfilePageComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
    BrowserAnimationsModule
  ],
  exports:[AlertComponent,SearchPipe],
  providers: [AlertService, AuthGuard,{
    provide:HTTP_INTERCEPTORS,
    useClass:TokenInterceptor,
    multi:true
  }],
  bootstrap: [AppComponent]
})
export class AppModule {
}
