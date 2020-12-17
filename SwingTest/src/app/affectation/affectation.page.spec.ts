import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { AffectationPage } from './affectation.page';

describe('AffectationPage', () => {
  let component: AffectationPage;
  let fixture: ComponentFixture<AffectationPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AffectationPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(AffectationPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
