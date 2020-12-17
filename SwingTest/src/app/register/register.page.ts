import { Component, OnInit } from '@angular/core';
import { NavController } from '@ionic/angular';
import { UserService } from '../services/user.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.page.html',
  styleUrls: ['./register.page.scss'],
})
export class RegisterPage implements OnInit {

  username: string = "";
  phone: string = "";
  showPassword = false;
  passwordToggleIcon = 'eye';
  check_pass: string = "";
  mail: string = "";
  password: string = "";
  constructor(public navCtrl: NavController, private service : UserService) { }

  ngOnInit() {
  }
  redirectLogin() {
    this.navCtrl.navigateForward("login");
  }


  addRegister() {
    console.log(this.username + " " + this.mail);
    if (this.username != "" || this.password == this.check_pass) {
      this.service.create(this.username,this.mail,this.password).subscribe(response =>{
        this.navCtrl.navigateForward("login");
      });
    }
  }
}
