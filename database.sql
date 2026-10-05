CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS projects (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  category VARCHAR(150) NOT NULL,
  description TEXT NOT NULL,
  description_fa TEXT NULL,
  url VARCHAR(255) NOT NULL,
  image VARCHAR(190) NULL,
  is_published TINYINT(1) NOT NULL DEFAULT 1,
  sort_order INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_pub_order (is_published, sort_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS skills (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  name_fa VARCHAR(100) NULL,
  category ENUM('frontend','backend','data','other') NOT NULL,
  sort_order INT NOT NULL DEFAULT 0,
  INDEX idx_cat_order (category, sort_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS contact_messages (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(190) NOT NULL,
  subject VARCHAR(150) NOT NULL,
  message TEXT NOT NULL,
  ip_hash CHAR(64) NOT NULL,
  is_read TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_ip_time (ip_hash, created_at),
  INDEX idx_read (is_read, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS site_settings (
  k VARCHAR(60) PRIMARY KEY,
  v TEXT NOT NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO site_settings (k,v) VALUES
('name','Abdul Aleem Matin'),('title','HTML & Front-End Development Specialist'),
('email','Abdulaleemmatin@mail.uk'),('phone','+93795093449'),('whatsapp','https://wa.me/93795093449'),
('linkedin','https://linkedin.com/in/abdul-aleem-matin-ba7258386'),('instagram','https://www.instagram.com/matinabdulaleem'),
('location','Mazar-i-Sharif, Afghanistan'),
('about','I am Abdul Aleem Matin, a web developer focused on building modern websites and digital experiences. My work combines frontend development, backend technologies, databases and practical web solutions.'),
('about_fa','من عبدالعلیم متین هستم، توسعه‌دهنده وب با تمرکز بر ساخت وب‌سایت‌ها و تجربه‌های دیجیتال مدرن. کار من فرانت‌اند، تکنالوژی‌های بک‌اند، پایگاه داده و راه‌حل‌های کاربردی وب را یکجا می‌آورد.')
ON DUPLICATE KEY UPDATE k=k;
INSERT INTO projects (title,category,description,description_fa,url,sort_order) VALUES
('AMU MART','E-Commerce / Web Development','A live e-commerce website. Visit the site to explore it.','یک وب‌سایت فروشگاهی فعال. برای دیدن آن از وب‌سایت بازدید کنید.','https://www.amumart.af',1),
('MAHDAVIAN BALKH','Web Development','A live website project. Visit the site to explore it.','یک پروژه وب‌سایت فعال. برای دیدن آن از وب‌سایت بازدید کنید.','https://www.mahdavianbalkh.com',2),
('AAM BEAST BRAND','Brand / Web Development','A live brand website. Visit the site to explore it.','وب‌سایت یک برند. برای دیدن آن از وب‌سایت بازدید کنید.','https://www.aambeastbrand.com',3),
('AMU TECH SOLUTIONS','Technology / Web Development','A live technology website. Visit the site to explore it.','یک وب‌سایت تکنالوژی. برای دیدن آن از وب‌سایت بازدید کنید.','https://www.amutechsolutions.com',4);
INSERT INTO skills (name,name_fa,category,sort_order) VALUES
('HTML',NULL,'frontend',1),('CSS',NULL,'frontend',2),('JavaScript',NULL,'frontend',3),('Responsive Web Design','طراحی وب واکنش‌گرا','frontend',4),('Frontend Development','توسعه فرانت‌اند','frontend',5),
('PHP',NULL,'backend',1),('Python',NULL,'backend',2),('WordPress',NULL,'backend',3),('Backend Development','توسعه بک‌اند','backend',4),('Website Development','توسعه وب‌سایت','backend',5),
('SQL',NULL,'data',1),('MySQL',NULL,'data',2),('Database Development','توسعه پایگاه داده','data',3),
('Teaching','تدریس','other',1),('Technology','تکنالوژی','other',2);
