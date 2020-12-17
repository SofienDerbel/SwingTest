import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { ShowUsersPage } from './show-users.page';

describe('ShowUsersPage', () => {
  let component: ShowUsersPage;
  let fixture: ComponentFixture<ShowUsersPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ShowUsersPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(ShowUsersPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
