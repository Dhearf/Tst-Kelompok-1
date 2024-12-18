<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff8dc;
        }
        .chat-container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            border: 1px solid #f1c40f;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .chat-header {
            background-color: #f1c40f;
            color: #fff;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px 8px 0 0;
        }
        .chat-messages {
            height: 300px;
            overflow-y: auto;
            padding: 15px;
            background-color: #fff;
        }
        .chat-messages .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 4px;
        }
        .chat-messages .message.sent {
            background-color: #fef9e7;
            align-self: flex-end;
        }
        .chat-messages .message.received {
            background-color: #f7dc6f;
        }
        .chat-input {
            display: flex;
            padding: 10px;
            background-color: #f9e79f;
            border-radius: 0 0 8px 8px;
            align-items: center;
        }
        .chat-input input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #f1c40f;
            border-radius: 4px;
            outline: none;
            font-size: 16px;
            margin-right: 10px;
        }
        .chat-input-buttons {
            display: flex;
            gap: 10px; 
        }
        .chat-input button {
            padding: 10px 15px;
            background-color: #f1c40f;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .chat-input button:hover {
            background-color: #d4ac0d;
        }
        .chat-input button svg {
            fill: #fff;
        }
        .success-message {
            color: green;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <!-- Chat Header -->
        <div class="chat-header">Chat App</div>

        <!-- Chat Messages Container -->
        <div class="chat-messages" id="chatMessages"></div>

        <!-- Chat Input and Buttons -->
        <div class="chat-input">
            <!-- Input Box -->
            <input type="text" id="messageInput" placeholder="Type your message here...">
            
            <!-- Button Container -->
            <div class="chat-input-buttons">
                <!-- Send Button -->
                <button id="sendButton">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                        <path d="M120 896v-192L720 576 120 448V256l720 320-720 320Z"/>
                    </svg>
                </button>

                <!-- Location Button -->
                <button class="location" id="locationButton">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                        <path d="M480 776q66 0 113-47t47-113q0-66-47-113t-113-47q-66 0-113 47t-47 113q0 66 47 113t113 47Zm0 280q-142-72-221-212.5T180 480q0-165 106.5-271.5T480 96q165 0 271.5 106.5T858 480q0 158-79 298.5T480 1056Z"/>
                    </svg>
                </button>
                <!-- POI Search Button -->
                <form action="read.php" method="get">
                    <button class="poi-search" name="search" value="wisata" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                            <path d="M796 935 533 672q-30 26-69.959 40.5T378 727q-108.162 0-183.081-75Q120 577 120 471t75-181q75-75 181.5-75t181 75Q632 365 632 471.15 617 531 602 571t-44 69l263 263-25 32ZM377.5 662q81.5 0 138.5-57T573 466q0-81-57-138.5T377.5 270q-81.5 0-138.5 57T182 466q0 81 57 138.5t138.5 57.5Z"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
