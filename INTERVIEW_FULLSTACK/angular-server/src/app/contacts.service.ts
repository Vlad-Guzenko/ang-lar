import {HttpClient} from '@angular/common/http';
import {Injectable} from '@angular/core';
import {Observable} from 'rxjs';
import { map} from 'rxjs/operators';

export interface Contact {
  id?:string
  first_name:string,
  last_name:string,
  job_title:string,
  company_name:string,
  email:string,
  age:number,
  created_at:Date
  updated_at:Date
}

export interface Email {
    email:string
}

export interface Message {
  message:string
}

@Injectable({providedIn: 'root'})
export class ContactsService {
  FormData:Contact
  constructor(private http: HttpClient) {
  }

  add(contact: Contact): Observable<Message> {
    return this.http
      .post<Message>("api/contacts",contact)
  }

  fetch(): Observable<Contact[]> {
    console.log('fetch');
    return this.http
      .get<Contact[]>("api/contacts")

  }

  getAllEm():Observable<Email[]>{
    return this.http.get<Email[]>("api/contacts/ems")
  }

  delete(id:string):Observable<Message>{
    const url = `api/contacts/${id}`
    return this.http
      .delete<Message>(url)
  }

  update(contact:Contact, id:string):Observable<Contact>{
    return this.http.put<Contact>(`api/contacts/${contact.id}`,contact)
      .pipe(map((contact:Contact)=> {
        return {
          ...contact,id,
          date: new Date(contact.updated_at)
        }
      }))
  }


  getById(id: string): Observable<Contact> {
    return this.http.get<Contact>(`api/contact/${id}`)
      .pipe(map((contact: Contact) => {
        return {
          ...contact, id,
          date: new Date(contact.updated_at)
        }
      }))
  }
}
