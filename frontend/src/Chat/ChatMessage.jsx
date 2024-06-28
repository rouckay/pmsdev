import { useContext } from "react";
import { ChatContext } from "./Context/ChatContext";

const ChatMessage = ({ message }) => {
  const { deleteMessage } = useContext(ChatContext);

  return (
    <div
      className={`relative p-3 mb-3 rounded-lg shadow-lg transition-shadow ${
        message.senderId === 1 ? "bg-blue-500 text-white" : "bg-gray-100"
      }`}
    >
      <div className="message-content">
        <span>{message.content}</span>
      </div>
      <button
        className="absolute top-0 right-0 p-1 text-red-500 hover:text-red-700"
        onClick={() => deleteMessage(message.id)}
      >
        &times;
      </button>
    </div>
  );
};

export default ChatMessage;
