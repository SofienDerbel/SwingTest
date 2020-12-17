import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';


export interface Task {
    id : string ;
    title : string ; 
    subject : string ; 
    max : number ; 

}
@Injectable({

providedIn : 'root'
})
export class TaskService {
    private url = 'http://localhost:8000/task';
    constructor (private http : HttpClient){

    }

    affect(id_task : number,id_user : number){
        return  this.http.post(this.url+"/affect",{
            task_id:id_task,
            user_id:id_user
        });
    }


    getAll(){
        return  this.http.get(this.url+'/all');
    }
    find(id:number){
        return this.http.get(this.url+'/find/'+id);
    }
    
    getVerification(username :string , password : string){
        return  this.http.post(this.url+"/login",{
            username:username,
            password:password
        });
    }

    /*get(id:string){
        return  this.http.get<[User]>(this.url+'/find/'+id);
    }*/

    create(title, subject, max){
        
        return  this.http.post(this.url+ "/add",{
            title: title,
            subject: subject,
            max: max
        }, );
    }

}