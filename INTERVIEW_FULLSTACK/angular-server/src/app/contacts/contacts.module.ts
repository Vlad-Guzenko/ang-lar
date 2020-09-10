import {NgModule} from "@angular/core";
import {AppComponent} from "../app.component";
import {ContactsComponent} from "./contacts.component";
import {CommonModule} from "@angular/common";
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {RouterModule} from "@angular/router";
import {CreateContactsComponent} from "../create-contacts/create-contacts.component";

@NgModule({
  declarations: [
  ],
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    RouterModule.forChild([
      {
        path: '', component: ContactsComponent, children: [
          {path: 'contacts', component: ContactsComponent, pathMatch: 'full'},
          {path: 'create', component: CreateContactsComponent}
        ]
      }
      ])
  ],
exports:[RouterModule]
})
export class ContactsModule {

}
