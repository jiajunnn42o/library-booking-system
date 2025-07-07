CREATE DATABASE IF NOT EXISTS library;
USE library;

-- ✅ 用户表：加入角色字段 + email 和 student_id 唯一
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  student_id VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('student', 'admin') DEFAULT 'student', -- ✅ 支持后台角色区分
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ✅ 图书表：加入库存（将来可扩展支持多本副本）
CREATE TABLE IF NOT EXISTS books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  author VARCHAR(100) NOT NULL,
  total_copies INT DEFAULT 1,       -- ✅ 新增字段：总本数
  available_copies INT DEFAULT 1,   -- ✅ 新增字段：可借本数（更精准）
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ✅ 借阅记录表：支持逾期、状态管理、归还时间
CREATE TABLE IF NOT EXISTS borrow_records (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  book_id INT NOT NULL,
  borrow_date DATE DEFAULT CURRENT_DATE,
  due_date DATE,                          -- ✅ 加入应还日期字段
  return_date DATE,
  status ENUM('borrowed', 'returned', 'overdue') DEFAULT 'borrowed',
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);
