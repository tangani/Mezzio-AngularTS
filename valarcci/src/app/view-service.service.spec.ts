import { TestBed } from '@angular/core/testing';

import { ViewServiceservice } from './view-serviceservice';

describe('ViewServiceService', () => {
  let service: ViewServiceservice;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ViewServiceservice);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
