import {Directive} from "@angular/core";
import {AbstractControl, AsyncValidator, ValidationErrors} from "@angular/forms";
import {Observable} from "rxjs";
import {ContactsService} from "./contacts.service";

/*@Directive({
  selector:'[uniqueEmail]'
})

export class UniqueEmailValidatorDirective implements AsyncValidator{
  constructor( private contactsService:ContactsServices) {
  }

  validate(c: AbstractControl): Promise<ValidationErrors | null> | Observable<ValidationErrors | null>{
    return this.contactsService.get
  }
}*/
