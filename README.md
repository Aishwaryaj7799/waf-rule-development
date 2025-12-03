# WAF Rule Development Project

This project demonstrates how to install, configure, and test a Web Application Firewall (WAF) using **ModSecurity**, **OWASP Core Rule Set (CRS)**, **Apache2 on Ubuntu**, and perform attack testing from **Kali Linux**.

It includes:
- Project report (WAF1.docx)
- Custom ModSecurity rules
- Screenshots of each step
- Test payloads and results

Project Overview
This project covers:

- Installing ModSecurity WAF on Ubuntu server  
- Enabling and configuring OWASP CRS  
- Switching WAF from *Detection* mode to *Blocking* mode  
- Creating custom WAF rules (SQLi, XSS, etc.)  
- Testing attacks from Kali Linux  
- Viewing Apache logs to confirm WAF blocks  
- Documenting attack behavior and protection  

Tools & Environment

| Component | Purpose |
|----------|---------|
| **Ubuntu** | Runs Apache2 + ModSecurity (WAF server) |
| **Apache2** | Hosts vulnerable web app (DVWA / login.php) |
| **ModSecurity** | Web Application Firewall engine |
| **OWASP CRS** | Rule set that detects attacks |
| **Kali Linux** | Attacker machine |
| **DVWA** | Vulnerable app for testing |

Installation Steps (Ubuntu – WAF Server)

Install ModSecurity
sudo apt update
sudo apt install libapache2-mod-security2 -y

Copy default ModSecurity config
sudo cp /etc/modsecurity/modsecurity.conf-recommended /etc/modsecurity/modsecurity.conf

Enable Blocking Mode
sudo sed -i 's/SecRuleEngine DetectionOnly/SecRuleEngine On/' /etc/modsecurity/modsecurity.conf

Enable CRS rules in security2.conf
/etc/apache2/mods-enabled/security2.conf

Restart Apache
sudo systemctl restart apache2

Custom Rule
<IfModule security2_module>
  SecRule ARGS "@rx (?i)union\s+select" \
  "id:10001,phase:2,block,msg:'SQL Injection Attempt: UNION SELECT detected'"
</IfModule>

Testing Attacks from Kali (Attacker Machine)
SQL Injection Test Input:
test' UNION SELECT 1,2,3--

Check logs on Ubuntu:
sudo tail -f /var/log/apache2/error.log


sudo apt update
sudo apt install libapache2-mod-security2 -y
