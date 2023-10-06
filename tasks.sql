CREATE TABLE tasks (
  task_id INT AUTO_INCREMENT PRIMARY KEY,
  task_title VARCHAR(100) NOT NULL,
  task_description TEXT,
  due_date DATE,
  status ENUM('Not Started', 'In Progress', 'Completed') NOT NULL
);

INSERT INTO tasks (task_title, task_description, due_date, status)
VALUES
  ('Install Operating System on New Workstation', 'Set up Windows 10 on a new Dell workstation.', '2023-07-20', 'Not Started'),
  ('Configure Network Switches', 'Set up VLANs and configure port security on network switches.', '2023-07-25', 'In Progress'),
  ('Troubleshoot Network Connectivity Issue', 'Investigate and resolve network connectivity problems.', '2023-07-22', 'Not Started'),
  ('Upgrade Server RAM', 'Install additional RAM modules on the server for improved performance.', '2023-07-26', 'Completed'),
  ('Install Software Updates', 'Apply the latest software updates and patches on all workstations.', '2023-07-24', 'In Progress'),
  ('Set Up New Employee Account', 'Create a user account and assign permissions for a new employee.', '2023-07-21', 'Completed'),
  ('Backup Database', 'Perform a full backup of the company database.', '2023-07-23', 'Not Started'),
  ('Monitor Server Health', 'Set up server monitoring to track CPU, memory, and disk usage.', '2023-07-28', 'In Progress'),
  ('Configure Firewall Rules', 'Update firewall rules to allow specific traffic and block unwanted access.', '2023-07-27', 'Not Started'),
  ('Implement Data Security Policy', 'Enforce data security measures to protect sensitive information.', '2023-07-30', 'Not Started');
