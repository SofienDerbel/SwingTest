import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { ShowUsersPageRoutingModule } from './show-users-routing.module';

import { ShowUsersPage } from './show-users.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ShowUsersPageRoutingModule
  ],
  declarations: [ShowUsersPage]
})
export class ShowUsersPageModule {}
