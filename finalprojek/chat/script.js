document.addEventListener('DOMContentLoaded', () => {
    const chatMessages = document.getElementById('chatMessages');
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');
    const locationButton = document.getElementById('locationButton');
    const poiSearchButton = document.querySelector('.poi-search'); // Updated to match class
  
    // Function to add messages to the chat
    function addMessage(message, type = 'sent') {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}`;
        messageDiv.innerHTML = message; // Use innerHTML for HTML formatting
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
  
    // Event listener for the send button
    sendButton.addEventListener('click', () => {
        const message = messageInput.value.trim();
        if (message) {
            addMessage(message, 'sent');
            messageInput.value = '';
        }
    });
  
    // JANGAN UBAH APAPUN DISINI
    locationButton.addEventListener('click', async () => {
        try {
            const response = await fetch('http://localhost/finalprojek/restful/server.php');
            const data = await response.json();
  
            if (data.status === 'success' && data.data.length > 0) {
                const locationDetails = data.data[0];
  
                const locationMessage = `📍 ${locationDetails.nama_lokasi} - (${locationDetails.latitude}, ${locationDetails.longitude})`;
                addMessage(locationMessage, 'sent');
  
                const successMessage = document.createElement('div');
                successMessage.className = 'success-message';
                successMessage.textContent = 'Lokasi berhasil terkirim';
                chatMessages.appendChild(successMessage);

                 //khansa
                const routeButton = document.createElement('button');
                routeButton.className = 'route-button';
                routeButton.textContent = 'Minta Rute';
                routeButton.addEventListener('click', async () => {
                    try {
                    //soap request body
                        const soapRequest = `
                            <soapenv:Envelope 
                                xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" >
                                    <soapenv:Body>
                                    <getDistance>
                                        <start>Universitas Brawijaya</start>
                                        <end>Gunung Bromo</end>
                                    </getDistance>
                                </soapenv:Body>
                            </soapenv:Envelope>`;

                // soap API call
                const routeResponse = await fetch('http://localhost/finalprojek/soap/soapserver.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'text/xml' },
                    body: soapRequest
                });
            
        
                // Parse XML Response
                const responseText = await routeResponse.text();
                console.log('SOAP Response:', responseText); // Debug log for checking response

                // Parse XML response to extract necessary data
                const parser = new DOMParser();
                const xmlDoc = parser.parseFromString(responseText, 'text/xml');

                // Extract data from XML response
                const start = xmlDoc.getElementsByTagName('start')[0]?.textContent;
                const end = xmlDoc.getElementsByTagName('end')[0]?.textContent;
                const distance = xmlDoc.getElementsByTagName('distance')[0]?.textContent;
                const routeDescription = xmlDoc.getElementsByTagName('routeDescription')[0]?.textContent;

                if (start && end && distance && routeDescription) {
                    addMessage(
                        `Rute dari ${start} ke ${end}:<br>` +
                        `- Jarak: ${distance}<br>` +
                        `- Deskripsi: ${routeDescription}`,
                        'info'
                    );
                } else {
                    alert('Gagal memproses data rute dari respons SOAP.');
                }
            } catch (err) {
                console.error('Fetch error:', err);
                alert(`Error saat meminta rute: ${err.message}`);
            }
        });

        chatMessages.appendChild(routeButton);
        //sampai sini khansa
            } else {
                alert('No location data available');
            }
        } catch (error) {
            console.error('Error fetching location data:', error);
            alert('Failed to fetch location');
        }
    });
    // SAMPAI SINI JANGAN DIUBAH


    // Event listener for the POI search button Alvina
    poiSearchButton.addEventListener('click', async (event) => {
        event.preventDefault();
        try {
            const response = await fetch('read.php?search=wisata');
            if (!response.ok) throw new Error('Gagal mengambil data');
            const data = await response.json();
  
            const formattedMessages = data.map(item =>
                `Nama Wisata: ${item.Nama_Lokasi} ||
                Deskripsi Wisata: ${item.Deskripsi_Lokasi} ||
                Kategori: ${item.Kategori} ||
                Rating: ${item.Rating} ||
                Jam Buka: ${item.Waktu_Buka} ||
                Kontak: ${item.Kontak_Lokasi}`
            );
            formattedMessages.forEach(msg => addMessage(msg, 'received'));
        } catch (error) {
            console.error('Error:', error);
            addMessage('Gagal mengambil data wisata.', 'received');
        }
    });

    // Event listener for pressing 'Enter' in the message input
    messageInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') sendButton.click();
    });
});
