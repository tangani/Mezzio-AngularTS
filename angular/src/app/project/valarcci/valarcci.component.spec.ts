import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ValarcciComponent } from './valarcci.component';

describe('ValarcciComponent', () => {
  let component: ValarcciComponent;
  let fixture: ComponentFixture<ValarcciComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ValarcciComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ValarcciComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
