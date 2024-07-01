import { Router } from '@angular/router';
import { ApiService } from '../api.service';
import { Component, OnInit } from '@angular/core';
import { ToastController } from '@ionic/angular';
import { DatePipe } from '@angular/common';

@Component({
  selector: 'app-pesanan',
  templateUrl: './pesanan.page.html',
  styleUrls: ['./pesanan.page.scss'],
})
export class PesananPage implements OnInit {
  responseData: any;
  date: any;

  constructor(
    private apiService: ApiService,
    private Router: Router,
    private toastCtrl: ToastController,

  ) {}

  ngOnInit() {
    this.showDataPesanan();
    this.responseData

  }

  showDataPesanan () {
    const storedData = localStorage.getItem('data');
    if (storedData) {
        const userData = JSON.parse(storedData);
        const userId = userData.user?.id;
        if (userId) {
            this.apiService.showDataRiwayat(userId).subscribe({
                next: (res: any) => {
                  this.responseData = res;
                },
                error: (error) => {
                    if (error.status === 401) {
                        this.presentToast('Silahkan Login untuk melanjutkan.');
                        this.Router.navigate(['/login']);
                    } else {
                        console.error('Error fetching data from cart:', error);
                    }
                }
            });
        } else {
            console.error('User ID not found in stored data');
            this.presentToast('Silahkan Login untuk melanjutkan.');
            this.Router.navigate(['/login']);
        }
    } else {
        console.error('No stored data found');
        this.presentToast('Silahkan Login untuk melanjutkan.');
        this.Router.navigate(['/login']);
    }
  }

  async presentToast(message: string) {
    const toast = await this.toastCtrl.create({
      message: message,
      mode: 'ios',
      duration: 2000,
      position: 'top',
    });

    toast.present();
  }

}
