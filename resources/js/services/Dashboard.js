export class DashboardService {

    getCountRegisters = async() => {
        const response = await fetch('/api/registers/count');
        const data = await response.json();
        return data;
    }

    // addPostgraduate = async (request, token) => {
    //     const requestOptions = {
    //         method: 'POST',
    //         headers: { 'Content-Type': 'application/json',
    //                     'X-CSRF-TOKEN': token},
    //         body: JSON.stringify(request)
    //     };
    //     const response = await fetch('/solicitud/postgraduate/add', requestOptions );
    //     const data = await response.json();
    //     return data;
    // }

}