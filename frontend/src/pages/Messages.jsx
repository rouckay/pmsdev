import { useState } from "react";
// import "./styles.css";

import ChatProvider from "../Chat/Context/ChatContext";
import GroupList from "../Chat/GroupList";
import CreateGroup from "../Chat/CreateGroup";
import FileSharing from "../Chat/FileSharing";
import Chat from "../Chat/Chat";

function App() {
  const [selectedGroupId, setSelectedGroupId] = useState(null);

  return (
    <ChatProvider>
      <div className="container mx-auto p-4 flex flex-col h-screen">
        <h1 className="text-2xl font-bold mb-4">Messenger Clone</h1>
        <div className="flex flex-grow">
          <div className="w-1/4 p-4 bg-white rounded-lg shadow-md">
            <CreateGroup />
            <GroupList onSelectGroup={setSelectedGroupId} />
          </div>
          <div className="w-3/4 p-4 flex flex-col">
            {selectedGroupId && <Chat groupId={selectedGroupId} />}
          </div>
        </div>
      </div>
    </ChatProvider>
  );
}

export default App;
