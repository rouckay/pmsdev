import React, { useContext, useState } from "react";

import ChatMessage from "./ChatMessage";
import { ChatContext } from "./Context/ChatContext";

const Chat = ({ groupId }) => {
  const { messages, addMessage } = useContext(ChatContext);
  const [newMessage, setNewMessage] = useState("");
  const [file, setFile] = useState(null);

  const handleSendMessage = () => {
    if (newMessage.trim() !== "" || file) {
      const message = {
        id: Date.now(),
        groupId,
        senderId: 1, // Assuming current user ID is 1
        content: newMessage,
        createdAt: new Date().toISOString(),
      };

      if (file) {
        message.content += ` (File shared: ${file.name})`;
        setFile(null);
      }

      addMessage(message);
      setNewMessage("");
    }
  };

  return (
    <div className="bg-white p-6 rounded-lg shadow-md flex flex-col h-full">
      <div className="messages mb-4 flex-grow overflow-y-auto space-y-4">
        {messages
          .filter((msg) => msg.groupId === groupId)
          .map((msg) => (
            <ChatMessage key={msg.id} message={msg} />
          ))}
      </div>
      <div className="input-group flex items-center space-x-2">
        <input
          type="file"
          onChange={(e) => setFile(e.target.files[0])}
          className="hidden"
          id="file-input"
        />
        <label
          htmlFor="file-input"
          className="cursor-pointer p-3 border border-gray-300 rounded-l-lg bg-gray-100 hover:bg-gray-200 transition-colors"
        >
          <svg
            className="w-6 h-6 text-gray-500"
            fill="currentColor"
            viewBox="0 0 24 24"
          >
            <path d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0zm4.688 9.438l-4.375 6.25c-.217.311-.59.312-.812 0L8.312 11.5a.5.5 0 0 1 .438-.812H10V8c0-.275.225-.5.5-.5h3c.275 0 .5.225.5.5v2.688h1.25a.5.5 0 0 1 .438.812zM15 16h-6v-2h6v2zm0-4h-6V6h6v6z" />
          </svg>
        </label>
        <input
          type="text"
          value={newMessage}
          onChange={(e) => setNewMessage(e.target.value)}
          className="flex-grow p-3 border border-gray-300 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Type a message..."
        />
        <button
          onClick={handleSendMessage}
          className="bg-blue-500 text-white p-3 rounded-r-lg hover:bg-blue-600 transition-colors"
        >
          Send
        </button>
      </div>
    </div>
  );
};

export default Chat;
