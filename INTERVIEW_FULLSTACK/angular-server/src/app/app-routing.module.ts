import {NgModule} from "@angular/core";
import {RouterModule, Routes} from "@angular/router";
import {AuthLayoutComponent} from "./shared/layouts/auth-layout/auth-layout.component";
import {SiteLayoutComponent} from "./shared/layouts/site-layout/site-layout.component";
import {LoginPageComponent} from "./login-page/login-page.component";
import {RegisterPageComponent} from "./register-page/register-page.component";
import {ContactsComponent} from "./contacts/contacts.component";
import {EditContactComponent} from "./edit-contact/edit-contact.component";
import {CreateContactsComponent} from "./create-contacts/create-contacts.component";
import {ProfilePageComponent} from "./profile-page/profile-page.component";
import {AuthGuard} from "./auth.guard";

const routes: Routes = [
  {
    path:'',component:AuthLayoutComponent,children:[
      {path: '', redirectTo:'/login',pathMatch:'full'},
      {path:'login',component:LoginPageComponent},
      {path:'register',component:RegisterPageComponent},
      {path:'logout',redirectTo: 'login'}
    ]
  },
  {
    path:'',component:SiteLayoutComponent,children:[
      {path:'contacts',component: ContactsComponent, canActivate:[AuthGuard]},
      {path: 'contacts/new',component: CreateContactsComponent,canActivate:[AuthGuard]},
      {path:'edit/:id',component: EditContactComponent,canActivate:[AuthGuard]},
      {path:'profile',component: ProfilePageComponent,canActivate:[AuthGuard]}
    ]
  }
]

@NgModule({
  imports: [
    RouterModule.forRoot(routes)
  ],
  exports: [
    RouterModule
  ]
})
export class AppRoutingModule {

}
