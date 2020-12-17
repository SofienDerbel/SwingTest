import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: 'home',
    loadChildren: () => import('./home/home.module').then( m => m.HomePageModule)
  },
  {
    path: '',
    redirectTo: 'login',
    pathMatch: 'full'
  },
  {
    path: 'login',
    loadChildren: () => import('./login/login.module').then( m => m.LoginPageModule)
  },
  {
    path: 'register',
    loadChildren: () => import('./register/register.module').then( m => m.RegisterPageModule)
  },
  {
    path: 'show-tasks',
    loadChildren: () => import('./show-tasks/show-tasks.module').then( m => m.ShowTasksPageModule)
  },
  {
    path: 'show-users',
    loadChildren: () => import('./show-users/show-users.module').then( m => m.ShowUsersPageModule)
  },
  {
    path: 'affectation',
    loadChildren: () => import('./affectation/affectation.module').then( m => m.AffectationPageModule)
  },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
