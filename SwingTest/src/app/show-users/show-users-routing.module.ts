import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ShowUsersPage } from './show-users.page';

const routes: Routes = [
  {
    path: '',
    component: ShowUsersPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class ShowUsersPageRoutingModule {}
