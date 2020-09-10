import {Pipe, PipeTransform} from '@angular/core';
import {Contact} from "../contacts.service";

@Pipe({
  name: 'searchContacts'
})
export class SearchPipe implements PipeTransform {
  transform(contacts: Contact[], search: string):Contact[] {
    if (!contacts || !search){
      return contacts
    }
    return contacts.filter(contact=>
      contact.first_name.toLowerCase().indexOf(search.toLowerCase()) ==1 ||
      contact.last_name.toLowerCase().indexOf(search.toLowerCase())!==-1 ||
      contact.email.toLowerCase().indexOf(search.toLowerCase())!==-1 ||
      contact.job_title.toLowerCase().indexOf(search.toLowerCase())!==-1 ||
      contact.company_name.toLowerCase().indexOf(search.toLowerCase())!==-1||
      contact.age.toString().toLowerCase().indexOf(search.toLowerCase())!==-1
    )
  }
}
