export class ProductService {

    getProducts = async() => {
        const response = await fetch('/sigi_barra_medica/public/api/products');
        const data = await response.json();
        return data;
    }

}