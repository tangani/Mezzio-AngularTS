interface Level {
  value: string;
  viewValue: string;
}

interface Dates {
  date: string;
  timezone_type: number;
  timezone: string;
}

export interface TableData {
  title:   String;
  manager: String;
  status:  String;
  start:   Array<3>;
  end:     Array<3>;
}
