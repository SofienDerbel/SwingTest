import { Component } from '@angular/core';
import { NavController, AlertController } from '@ionic/angular';
import { TaskService, Task } from '../services/task.service';
@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {

  max : number=0; 
  subject : string="" ; 
  title : string =""; 
  constructor(public navCtrl : NavController, public alertController : AlertController, private service : TaskService) { }

  addTask(){
    this.service.create(this.title, this.subject, this.max).subscribe(response => {
      // TODO: add condition if credentials are wrong
        this.presentAlert("Success", "task addedd successfully");
     });
  }

  async presentAlert(title: string, message: string){
    const alert = await this.alertController.create({
      header:title,
      subHeader:title,
      message:message,
      buttons : ['ok']
    });
    await alert.present();
    let result = await alert.onDidDismiss();
  }
}
