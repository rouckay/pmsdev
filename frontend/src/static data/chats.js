const staticChat = {
  users: [
    { id: 1, name: "John Doe", email: "john@example.com" },
    { id: 2, name: "Jane Smith", email: "jane@example.com" },
  ],
  groups: [
    { id: 1, name: "Group 1", description: "First Group", createdBy: 1 },
    { id: 2, name: "Group 2", description: "Second Group", createdBy: 2 },
  ],
  messages: [
    {
      id: 1,
      groupId: 1,
      senderId: 1,
      content: "Hello Group 1!",
      createdAt: "2024-06-01T12:00:00Z",
    },
    {
      id: 2,
      groupId: 2,
      senderId: 2,
      content: "Hello Group 2!",
      createdAt: "2024-06-02T12:00:00Z",
    },
  ],
};

export default staticChat;
