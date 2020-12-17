import { Component, OnInit } from '@angular/core';
import { NavController, NavParams, AlertController } from '@ionic/angular';
import { RegisterPage } from '../register/register.page';
import { UserService, User } from '../services/user.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {
password : string ="";
username : string ="";
user : any ; 
  constructor(public navCtrl : NavController, public alertController : AlertController, private service : UserService) { }

  async presentAlert(title:string, message: string){
    const alert = await this.alertController.create({
      header:title,
      subHeader:'Warning',
      message:message,
      buttons : ['ok']
    });
    await alert.present();
    let result = await alert.onDidDismiss();
  }
  ngOnInit() {
   
  }
  redirectRegister(){
    this.navCtrl.navigateForward("register");
  }
  redirectMenu(){
    if(this.password==""||this.username==""){
      this.presentAlert("Alert", "Username/Password can't be empty!.");
    }
    else {     
      this.service.getVerification(this.username, this.password).subscribe(response => {
         this.user = response;
         if (this.user.error){
          this.presentAlert("Alert", "Please verify your credentials");
         }else {
          this.navCtrl.navigateForward("home");
         }

       });
    

    }
  }

}
