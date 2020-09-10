import {Component, OnDestroy, OnInit} from '@angular/core';
import {Contact, ContactsService, Message} from "../contacts.service";
import {Router} from "@angular/router";
import {Subscription} from "rxjs";
import {AlertService} from "../shared/services/alert.service";

@Component({
  selector: 'app-contacts',
  templateUrl: './contacts.component.html',
  providers: [ContactsService]
})
export class ContactsComponent implements OnInit, OnDestroy{
  contacts: Contact[] = []
  contact:Contact
  del:boolean
  message: Message
  pSub: Subscription
  dSub: Subscription
  searchStr = ''
  empty:boolean
  //startIndex = 0
  //endIndex = 4

  constructor(private contactsService: ContactsService,
              private router: Router,
              private alert:AlertService) {
  }

  ngOnInit() {

    setTimeout(()=>{
      /*this.contactsService.getAllEm().subscribe(ems=>{
      this.emails = ems
    })*/
      this.pSub = this.contactsService.fetch().subscribe(contacts => {
        this.contacts = contacts
      })
      console.log(this.contacts)

    },1000)//loading imitation
  }

  delete(id: string) {
      this.dSub = this.contactsService.delete(id).subscribe(() => {
        this.contacts = this.contacts.filter(contact => contact.id !== id)
        this.alert.success('Contact was deleted')
        this.del = true
      })
  }

  ngOnDestroy() {
    if (this.pSub) {
      this.pSub.unsubscribe()
    }

    if (this.dSub) {
      this.dSub.unsubscribe()
    }
  }

}

