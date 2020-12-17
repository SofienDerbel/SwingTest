import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { ShowTasksPage } from './show-tasks.page';

describe('ShowTasksPage', () => {
  let component: ShowTasksPage;
  let fixture: ComponentFixture<ShowTasksPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ShowTasksPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(ShowTasksPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
