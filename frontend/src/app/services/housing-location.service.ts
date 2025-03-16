import { Injectable } from '@angular/core';
import { HousingLocation } from '../interfaces/housing-location';

@Injectable({
  providedIn: 'root'
})
export class HousingLocationService {
  // URL de la API en PHP (asegúrate de que sea correcta según tu servidor local)
  private apiUrl = 'http://localhost/proyecto/backend/controllers/Locations.php';

  constructor() { }

  async getAllHousingLocation(): Promise<HousingLocation[]> {
    try {
      const data = await fetch(this.apiUrl);
      if (!data.ok) {
        throw new Error(`Error HTTP: ${data.status}`);
      }
      const response = await data.json();
      return response.datos;
    } catch (error) {
      console.error('Error al obtener datos:', error);
      return [];
    }
  }

  async getHousingLocationById(id: number): Promise<HousingLocation | undefined> {
    const url = `${this.apiUrl}?id=${id}`;
    try {
      const data = await fetch(url);
      if (!data.ok) {
        throw new Error(`Error HTTP: ${data.status}`);
      }
      const response = await data.json();
      return response.datos;
    } catch (error) {
      console.error('Error al obtener datos:', error);
      return undefined;
    }
  }

  submitApplication(firstName: string, lastName: string, email: string) {
    console.log(`FirstName: ${firstName} - LastName: ${lastName} - Email: ${email}`);
  }
}

