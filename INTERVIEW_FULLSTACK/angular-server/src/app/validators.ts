import {FormControl} from "@angular/forms";

export class myValidators {

  static restrictedEmail(control:FormControl):{[key:string]:boolean}{
    if (['v@mail.ru']){
      return {
        restrictedEmail:true
      }
    }
    return null
  }
}
