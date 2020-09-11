export class Details {
  firstName: string;
  surname: string;
  userName: string;
  password: string;
  telephoneNumber: number;
  email: string;
  agree: boolean;
  contactType: string;
}

export class Login {
  userName: string;
  password: string;
}

export const ContactType = [ 'None', 'Tel', 'Email']
