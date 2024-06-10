const staticData = {
    roles: [
        { id: 1, name: 'Admin', guard_name: 'admin' },
        { id: 2, name: 'User', guard_name: 'user' }
    ],
    users: [
        {
            id: 1,
            name: 'John Doe',
            user_name: 'johndoe',
            email: 'john@example.com',
            password: 'password123',
            type: 'admin',
            phone_number: '1234567890',
            address: '123 Main St',
            remember_token: null,
            created_by: 1,
            active: true
        },
        {
            id: 2,
            name: 'Jane Smith',
            user_name: 'janesmith',
            email: 'jane@example.com',
            password: 'password123',
            type: 'user',
            phone_number: '0987654321',
            address: '456 Elm St',
            remember_token: null,
            created_by: 1,
            active: true
        }
    ],
    companies: [
        { id: 1, name: 'Company A', created_by: 1 },
        { id: 2, name: 'Company B', created_by: 2 }
    ],
    departments: [
        { id: 1, name: 'HR', description: 'Human Resources', company_id: 1, active: true, created_by: 1 },
        { id: 2, name: 'Engineering', description: 'Engineering Department', company_id: 2, active: true, created_by: 2 }
    ],
    projects: [
        {
            id: 1,
            name: 'Project Alpha',
            description: 'Alpha Project Description',
            start_date: '2024-01-01',
            end_date: '2024-12-31',
            department_id: 1,
            active: true,
            created_by: 1
        },
        {
            id: 2,
            name: 'Project Beta',
            description: 'Beta Project Description',
            start_date: '2024-02-01',
            end_date: '2024-11-30',
            department_id: 2,
            active: true,
            created_by: 2
        }
    ],
    tasks: [
        {
            id: 1,
            name: 'Task 1',
            project_id: 1,
            description: 'Description for Task 1',
            start_date: '2024-01-10',
            end_date: '2024-01-20',
            assigned_to: 1,
            percentage: 50,
            status: 'In Progress',
            due_date: '2024-01-20',
            created_by: 1
        },
        {
            id: 2,
            name: 'Task 2',
            project_id: 2,
            description: 'Description for Task 2',
            start_date: '2024-02-10',
            end_date: '2024-02-20',
            assigned_to: 2,
            percentage: 30,
            status: 'Not Started',
            due_date: '2024-02-20',
            created_by: 2
        }
    ],
    resources: [
        { id: 1, project_id: 1, name: 'Resource 1', resource_type: 'Type A', quantity: 100, created_by: 1 },
        { id: 2, project_id: 2, name: 'Resource 2', resource_type: 'Type B', quantity: 200, created_by: 2 }
    ],
    taskAssignments: [
        { id: 1, task_id: 1, user_id: 1, assigned_date: '2024-01-10', created_by: 1 },
        { id: 2, task_id: 2, user_id: 2, assigned_date: '2024-02-10', created_by: 2 }
    ],
    fileSharing: [
        { id: 1, project_id: 1, user_id: 1, document_url: 'http://example.com/doc1', message: 'Document 1', created_by: 1 },
        { id: 2, project_id: 2, user_id: 2, document_url: 'http://example.com/doc2', message: 'Document 2', created_by: 2 }
    ],
    groups: [
        { id: 1, project_id: 1, name: 'Group 1', description: 'Description for Group 1', created_by: 1 },
        { id: 2, project_id: 2, name: 'Group 2', description: 'Description for Group 2', created_by: 2 }
    ],
    groupMembers: [
        { id: 1, group_id: 1, user_id: 1, joined_at: '2024-01-15', created_by: 1 },
        { id: 2, group_id: 2, user_id: 2, joined_at: '2024-02-15', created_by: 2 }
    ],
    messages: [
        { id: 1, sender_id: 1, user_id: 2, content: 'Hello from John to Jane', group_id: 1, created_at: '2024-01-16', created_by: 1 },
        { id: 2, sender_id: 2, user_id: 1, content: 'Hello from Jane to John', group_id: 2, created_at: '2024-02-16', created_by: 2 }
    ]
};

export default staticData;
