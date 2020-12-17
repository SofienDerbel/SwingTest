import { Component, OnInit } from '@angular/core';
import { AlertController, NavController } from '@ionic/angular';
import { TaskService } from '../services/task.service';
import { NavigationOptions } from '@ionic/angular/providers/nav-controller';
import { NavigationExtras, Router } from '@angular/router';

@Component({
  selector: 'app-show-tasks',
  templateUrl: './show-tasks.page.html',
  styleUrls: ['./show-tasks.page.scss'],
})
export class ShowTasksPage implements OnInit {

  public tasks: any;
  public task: any;
  public navOptions: NavigationOptions;
  constructor(private router: Router, public navCtrl: NavController, public alertController: AlertController, private service: TaskService) { }

  ngOnInit() {
    this.service.getAll().subscribe(response => {
      this.tasks = response;

    });
  }
  affecter(e: any) {
    let navigationExtras: NavigationExtras = {
      queryParams: {
        currentTask: JSON.stringify(e)
      }
    };
    this.router.navigate(['affectation'], navigationExtras);
  }

}
