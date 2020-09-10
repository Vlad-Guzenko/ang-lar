import {HttpClient} from '@angular/common/http';
import {Injectable} from '@angular/core';
import {BehaviorSubject, Observable} from 'rxjs';
import {map} from "rxjs/operators";
import {Contact, Email} from "./contacts.service";
import {Router} from "@angular/router";

export interface User {
  id?:string
  first_name:string,
  last_name:string,
  email:string,
  password:string,
  age:Date,
  updated_at:Date
  exp:number
  token:string
}

export interface Email {
  email:string
}

@Injectable({providedIn: 'root'})
export class UserService {
  private currentUserSubject: BehaviorSubject<User>;
  public currentUser: Observable<User>;
  FormData:User
  private isAuth = true
  private token:string
  constructor(private http: HttpClient,
              private router:Router) {
    this.currentUserSubject = new BehaviorSubject<User>(JSON.parse(localStorage.getItem('currentUser')));
    this.currentUser = this.currentUserSubject.asObservable();
  }

  public get currentUserValue(): User {
    return this.currentUserSubject.value;
  }


  private setToken(token:string):void{
    localStorage.setItem('currentUser',token)
    this.token = token
  }

  public getToken(): string {
    return localStorage.getItem('currentUser');
  }


  login(user: User): Observable<User> {
    return this.http
      .post<User>("api/login",user).pipe(map(user => {
        // store user details and jwt token in local storage to keep user logged in between page refreshes
        localStorage.setItem('currentUser', JSON.stringify(user));
        this.currentUserSubject.next(user);
        return user;
      }));
    /*this.isAuth = false*/
  }




  register(user: User):Observable<User>{
    return this.http.post<User>("api/register",user)
  }

  getAllEm():Observable<Email[]>{
    return this.http.get<Email[]>("api/contacts/ems")
  }

  update(user:User, id:string):Observable<User>{
    return this.http.put<User>(`api/user/${user.id}`,user)
      .pipe(map((user:User)=> {
        return {
          ...user,id,
          date: new Date(user.updated_at)
        }
      }))
  }

  logout() {
    localStorage.removeItem('currentUser');
    this.currentUserSubject.next(null);
    this.router.navigateByUrl('/')
  }

  /*delete(id:string):Observable<Message>{
    const url = `api/contacts/${id}`
    return this.http
      .delete<Message>(url)
  }*/

  /*update(user:User, id:string):Observable<User>{
    return this.http.put<User>(`api/contacts/${user.id}`,user)
      .pipe(map((user:User)=> {
        return {
          ...user,id,
          date: new Date(user.updated_at)
        }
      }))
  }*/


  /*getById(id: string): Observable<User> {
    return this.http.get<User>(`api/contact/${id}`)
      .pipe(map((user: User) => {
        return {
          ...user, id,
          date: new Date(user.updated_at)
        }
      }))
  }*/
}
