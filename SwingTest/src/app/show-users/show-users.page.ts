import { Component, OnInit } from '@angular/core';
import { NavController, AlertController } from '@ionic/angular';
import { UserService } from '../services/user.service';

@Component({
  selector: 'app-show-users',
  templateUrl: './show-users.page.html',
  styleUrls: ['./show-users.page.scss'],
})
export class ShowUsersPage implements OnInit {

  constructor(public navCtrl : NavController, public alertController : AlertController, private service : UserService) { }

  ngOnInit() {
    this.service.getAll().subscribe(response => {
      console.log(response);
  });
  }

}
