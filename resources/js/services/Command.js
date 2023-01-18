export class CommandService {
    
    storeCommand = async (command, token) => {
        const requestOptions = {
            method: 'POST',
            headers: { 'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token},
            body: JSON.stringify(command)
        };
        const response = await fetch('/api/command/add', requestOptions );
        const data = await response.json();
        return data;
    }
}