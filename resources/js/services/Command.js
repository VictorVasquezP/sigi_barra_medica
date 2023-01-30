export class CommandService {

    storeCommand = async(command, token) => {
        const requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(command)
        };
        const response = await fetch('/api/command/add', requestOptions);
        const data = await response.json();
        return data;
    }

    editCommand = async(command, token) => {
        const requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(command)
        };
        const response = await fetch('/api/command/edit', requestOptions);
        const data = await response.json();
        return data;
    }

    updateStatusCommand = async(command, token, type) => {
        command.type = type;
        const requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(command)
        };
        const response = await fetch('/api/command/updateStatusCommand', requestOptions, type);
        const data = await response.json();
        console.log(data);
        return data;
    }

    saveInsumos = async(insumos, token, id) => {
        let command = {
            products: insumos
        }
        const requestOptions = {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(command)
        };
        const response = await fetch('/api/save-insumos/' + id, requestOptions);
        const data = await response.json();
        return data;
    }

    getInsumos = async(id) => {
        const response = await fetch('/api/command/' + id + '/insumos');
        const data = await response.json();
        return data;
    }

    getRooms = async() => {
        const response = await fetch('/api/rooms');
        const data = await response.json();
        return data;
    }
}