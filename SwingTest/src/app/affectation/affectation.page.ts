import { Component, OnInit } from '@angular/core';
import { NavController, AlertController } from '@ionic/angular';

import { UserService } from '../services/user.service';
import { ActivatedRoute, Router } from '@angular/router';
import { TaskService } from '../services/task.service';

@Component({
  selector: 'app-affectation',
  templateUrl: './affectation.page.html',
  styleUrls: ['./affectation.page.scss'],
})
export class AffectationPage implements OnInit {
  data: any;
  availableUsers: any = [];
  constructor(private route: ActivatedRoute, private router: Router,public navCtrl: NavController, public alertController: AlertController, private service: UserService,private serviceTask: TaskService) {
    this.route.queryParams.subscribe(params => {

      if (params && params.currentTask) {
        this.data =JSON.parse(params.currentTask);  
          
        console.log(this.data.id)
        /*this.service.getAllU(this.data.id).subscribe(response => {
          this.availableUsers = response;
        }); */ 
      }
      this.initializaJSONData();

    });
    
  }
  
  FilterJsonData(ev: any) {

    const val = ev.target.value;
    if (val && val.trim() != '') {
      this.availableUsers = this.availableUsers.filter((item) => {
        return (item.username.toLowerCase().indexOf(val.toLowerCase()) > -1);
      });
    }
    else this.initializaJSONData();
  }
  async presentAlert(title: string, user: string, idUser:number){
      const alert = await this.alertController.create({
        cssClass: 'my-custom-class',
        header: 'Adding '+user+' for '+title +' !',
        message: 'Do you want to add mr/mrs <strong>'+user+'</strong> to the following task : '+title,
        buttons: [
          {
            text: 'No',
            role: 'cancel',
            cssClass: 'secondary',
            handler: (blah) => {
              console.log('Confirm Cancel: blah');
            }
          }, {
            text: 'Yes',
            handler: () => {
              console.log('Confirm Okay');
             
              this.serviceTask.affect(this.data.id,idUser).subscribe(response => {
                  console.log(response);
                  this.navCtrl.navigateForward("show-tasks");
              });

            }
          }
        ]
      });
  
      await alert.present();
    }
  selectVal(val) {
    this.presentAlert(this.data.title,val.username,val.id);

  }
  ngOnInit() {
  }
  initializaJSONData() {
    if(this.data.id!==undefined){
      this.service.getAllU(this.data.id).subscribe(response => {
        this.availableUsers = response;
      });
  }}

}
