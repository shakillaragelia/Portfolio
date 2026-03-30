<?php

return [
    'hero' => [
        'name' => 'John Doe',
        'role' => 'Full Stack Developer & Cyber Security Enthusiast',
        'tagline' => 'Building secure, scalable, and visually stunning web applications.',
        'description' => 'I specialize in Laravel, Vue.js, and modern CSS frameworks like Tailwind CSS. Passionate about creating seamless user experiences and robust backend systems.',
        'image' => '/images/avatar.jpg',
    ],
    
    'about' => [
        'title' => 'About Me',
        'content' => 'With over 5 years of experience in web development, I have a deep understanding of the full software development lifecycle. I thrive in challenging environments and constantly seek to learn new technologies and security practices.',
    ],

    'skills' => [
        ['name' => 'Laravel', 'level' => 90],
        ['name' => 'Vue.js', 'level' => 85],
        ['name' => 'Tailwind CSS', 'level' => 95],
        ['name' => 'Cyber Security', 'level' => 80],
        ['name' => 'MySQL / PostgreSQL', 'level' => 85],
    ],

    'projects' => [
        [
            'title' => 'E-Commerce Platform',
            'description' => 'A fully scalable e-commerce platform with real-time inventory management and secure payment gateways.',
            'image' => 'https://images.unsplash.com/photo-1557821552-171051530d19?q=80&w=800&auto=format&fit=crop',
            'tags' => ['Laravel', 'Vue.js', 'Stripe'],
            'link' => '#',
        ],
        [
            'title' => 'Security Audit Tool',
            'description' => 'An automated penetration testing toolkit for web applications to find common vulnerabilities.',
            'image' => 'https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?q=80&w=800&auto=format&fit=crop',
            'tags' => ['Python', 'Bash', 'Security'],
            'link' => '#',
        ],
        [
            'title' => 'Interactive Dashboard',
            'description' => 'Data visualization dashboard for business intelligence with real-time websocket updates.',
            'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=800&auto=format&fit=crop',
            'tags' => ['Vue 3', 'Tailwind', 'Pusher'],
            'link' => '#',
        ],
    ],

    'security_interests' => [
        'Web Application Firewall evasion',
        'Zero-day vulnerability research',
        'Secure coding practices',
        'Penetration testing & Red Teaming',
    ],

    'contact' => [
        'email' => 'hello@johndoe.com',
        'github' => 'https://github.com/johndoe',
        'linkedin' => 'https://linkedin.com/in/johndoe',
        'twitter' => 'https://twitter.com/johndoe',
    ]
];
