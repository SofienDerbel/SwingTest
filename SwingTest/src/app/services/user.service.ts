import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';


export interface User {
    id : string ;
    username : string ; 
    email : string ; 
    password : string ; 

}
@Injectable({

providedIn : 'root'
})
export class UserService {
    private url = 'http://localhost:8000/user';
    constructor (private http : HttpClient){

    }


    getAll(){
        return  this.http.get<[User]>(this.url+'/all');
    }
    getAllU(task_id:number){
        return  this.http.get(this.url+'/findOtherUsers/'+ task_id);
    }

    getVerification(username :string , password : string){
        return  this.http.post(this.url+"/login",{
            username:username,
            password:password
        });
    }

    get(id:string){
        return  this.http.get<[User]>(this.url+'/find/'+id);
    }
    create(username: string, email:string, password: string){
        return  this.http.post(this.url+ "/register",{
            username: username,
            email: email,
            password: password
        });
    }

}