import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ShowTasksPage } from './show-tasks.page';

const routes: Routes = [
  {
    path: '',
    component: ShowTasksPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class ShowTasksPageRoutingModule {}
