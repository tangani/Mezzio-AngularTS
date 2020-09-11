import { Routes, RouterModule } from '@angular/router';

import { ElementsComponent } from '../elements/elements.component';
import { HomeComponent } from "../project/home/home.component";
import { ViewsComponent } from "../project/views/views.component";

export const routes: Routes = [
  { path: 'elements',      component: ElementsComponent},
  { path: 'project/home',  component: HomeComponent},
  { path: 'project/views', component:ViewsComponent}
];
