import { createContext, useState } from "react";

export const ChatContext = createContext();

const ChatProvider = ({ children }) => {
  const [groups, setGroups] = useState([]);
  const [messages, setMessages] = useState([]);

  const addGroup = (group) => {
    setGroups([...groups, group]);
  };

  const addMessage = (message) => {
    setMessages([...messages, message]);
  };

  const deleteMessage = (messageId) => {
    setMessages(messages.filter((message) => message.id !== messageId));
  };

  return (
    <ChatContext.Provider
      value={{ groups, addGroup, messages, addMessage, deleteMessage }}
    >
      {children}
    </ChatContext.Provider>
  );
};

export default ChatProvider;
