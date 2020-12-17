import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { ShowTasksPageRoutingModule } from './show-tasks-routing.module';

import { ShowTasksPage } from './show-tasks.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ShowTasksPageRoutingModule
  ],
  declarations: [ShowTasksPage]
})
export class ShowTasksPageModule {}
