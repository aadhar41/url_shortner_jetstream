<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Guide to the Short URL System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Chosen Palette: Sandstone & Sage -->
    <!-- Application Structure Plan: The SPA is designed as a vertical "explainer" page. It starts with a hero section introducing the system. The core is an interactive RBAC (Role-Based Access Control) simulator where users can select a role and see how permissions and data visibility change in real-time. This is more effective than reading static rules. This is followed by a grid explaining other key features (tracking, export) and concludes with an HTML/CSS-based flowchart visualizing the URL creation and resolution processes. This structure was chosen to turn a dense technical document into an engaging learning experience. -->
    <!-- Visualization & Content Choices: 1. RBAC Simulator: Report Info (Creation/Visibility rules) -> Goal (Explore rules) -> Viz (Interactive buttons + dynamic table) -> Interaction (Click role button to filter table and toggle 'Create' button state) -> Justification (Learning by doing is superior to reading static tables) -> Library (Vanilla JS). 2. Process Flow: Report Info (URL creation/resolution flow) -> Goal (Explain processes) -> Viz (Diagram) -> Interaction (None) -> Justification (Flowcharts are ideal for process visualization) -> Library (HTML/Tailwind CSS). -->
    <!-- CONFIRMATION: NO SVG graphics used. NO Mermaid JS used. -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #FDFBF7;
            /* Sandstone */
            color: #5C5552;
            /* Sage-Brown */
        }

        .accent-bg {
            background-color: #A6B1A9;
        }

        /* Sage */
        .accent-text {
            color: #A6B1A9;
        }

        .accent-bg-dark {
            background-color: #727C75;
        }

        .highlight-bg {
            background-color: #EAE6E1;
        }

        .btn-role.active {
            background-color: #727C75;
            color: #FFFFFF;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            transform: translateY(-2px);
        }

        .flow-box {
            border: 2px solid #EAE6E1;
            padding: 1rem;
            border-radius: 0.5rem;
            text-align: center;
            background-color: #fff;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .flow-arrow {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #A6B1A9;
            padding: 0 1rem;
        }

        @media (max-width: 768px) {
            .flow-arrow {
                transform: rotate(90deg);
                padding: 1rem 0;
            }
        }
    </style>
</head>

<body class="antialiased">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Hero Section -->
        <header class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Short URL Management System</h1>
            <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">An interactive guide to the system's features
                and its powerful Role-Based Access Control (RBAC) policy.</p>
        </header>

        <!-- RBAC Simulator Section -->
        <section id="simulator" class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">RBAC Policy Simulator</h2>
                <p class="mt-2 text-gray-600">Select a role to see how permissions and data visibility change.</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <!-- Role Selector -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4 text-center">Simulate As:</h3>
                    <div class="flex justify-center flex-wrap gap-4" id="role-selector">
                        <button class="btn-role text-lg font-semibold py-3 px-6 rounded-lg transition-all duration-300"
                            data-role="Member">Member</button>
                        <button class="btn-role text-lg font-semibold py-3 px-6 rounded-lg transition-all duration-300"
                            data-role="Admin">Admin</button>
                        <button class="btn-role text-lg font-semibold py-3 px-6 rounded-lg transition-all duration-300"
                            data-role="SuperAdmin">SuperAdmin</button>
                    </div>
                </div>

                <!-- Actions & Permissions -->
                <div class="highlight-bg p-6 rounded-lg mb-8">
                    <h4 class="font-semibold text-gray-800 text-xl mb-4 text-center">Permissions for <span
                            id="current-role-display" class="font-bold"></span></h4>
                    <div class="flex justify-center items-center">
                        <button id="create-url-btn"
                            class="px-6 py-3 font-semibold rounded-md transition-colors duration-300 flex items-center gap-2">
                            <span>279C</span> Create New Short URL
                        </button>
                    </div>
                    <p id="create-permission-text" class="text-center mt-3 text-sm"></p>
                </div>

                <!-- Simulated Data Table -->
                <div>
                    <h4 class="font-semibold text-gray-800 text-xl mb-4">Simulated URL List</h4>
                    <p id="visibility-text" class="text-center mb-4 text-sm"></p>
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Original URL</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Short Code</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Creator</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Company</th>
                                </tr>
                            </thead>
                            <tbody id="url-table-body" class="bg-white divide-y divide-gray-200">
                                <!-- JS will populate this -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <!-- Key Features Section -->
        <section id="features" class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Key System Features</h2>
                <p class="mt-2 text-gray-600">Beyond permissions, the system offers several core functionalities.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                    <div class="text-4xl mb-4 accent-text">📈</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Access Tracking</h3>
                    <p class="text-gray-600">Every click on a short URL is counted, providing valuable insight into link
                        performance and engagement.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                    <div class="text-4xl mb-4 accent-text">📥</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Data Export</h3>
                    <p class="text-gray-600">Users can download a CSV file of the short URL data they are authorized to
                        view, for offline analysis or reporting.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                    <div class="text-4xl mb-4 accent-text">🌍</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Public Redirection</h3>
                    <p class="text-gray-600">All short links are publicly resolvable, meaning anyone can use them
                        without needing to log into the system.</p>
                </div>
            </div>
        </section>

        <!-- Flowchart Section -->
        <section id="flowcharts">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Process Flow</h2>
                <p class="mt-2 text-gray-600">Visualizing the core user journeys.</p>
            </div>
            <div class="space-y-12">
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">URL Creation Flow</h3>
                    <div class="flex flex-col md:flex-row justify-center items-stretch">
                        <div class="flow-box">User (Admin/Member)<br>provides long URL</div>
                        <div class="flow-arrow">→</div>
                        <div class="flow-box">System generates<br>unique short code</div>
                        <div class="flow-arrow">→</div>
                        <div class="flow-box">New Short URL<br>is created and listed</div>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">URL Resolution Flow</h3>
                    <div class="flex flex-col md:flex-row justify-center items-stretch">
                        <div class="flow-box">Anyone visits<br>yourdomain.com/short_code</div>
                        <div class="flow-arrow">→</div>
                        <div class="flow-box">System finds original URL<br>& increments click count</div>
                        <div class="flow-arrow">→</div>
                        <div class="flow-box">User is instantly<br>redirected to original URL</div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <script>
        const mockData = [{
                id: 1,
                original_url: 'https://example.com/very-long-product-page-1',
                short_code: 'aB3xZ',
                user_id: 1,
                user_name: 'Alice (Member)',
                company_id: 1,
                company_name: 'Innovate Inc.'
            },
            {
                id: 2,
                original_url: 'https://example.com/internal-document-link',
                short_code: 'cDEfg',
                user_id: 3,
                user_name: 'Charlie (Admin)',
                company_id: 1,
                company_name: 'Innovate Inc.'
            },
            {
                id: 3,
                original_url: 'https://google.com/search-query',
                short_code: 'hIjK9',
                user_id: 1,
                user_name: 'Alice (Member)',
                company_id: 1,
                company_name: 'Innovate Inc.'
            },
            {
                id: 4,
                original_url: 'https://another-domain.org/resource-article',
                short_code: 'LMnP7',
                user_id: 2,
                user_name: 'Bob (Member)',
                company_id: 2,
                company_name: 'Solutions Co.'
            },
            {
                id: 5,
                original_url: 'https://solutions.co/contact-us-page',
                short_code: 'QrS2t',
                user_id: 2,
                user_name: 'Bob (Member)',
                company_id: 2,
                company_name: 'Solutions Co.'
            },
        ];

        const roleSelector = document.getElementById('role-selector');
        const urlTableBody = document.getElementById('url-table-body');
        const createUrlBtn = document.getElementById('create-url-btn');
        const currentRoleDisplay = document.getElementById('current-role-display');
        const createPermissionText = document.getElementById('create-permission-text');
        const visibilityText = document.getElementById('visibility-text');

        let currentUser = {
            id: 1,
            role: 'Member',
            company_id: 1
        };

        function render() {
            // Update role display
            const activeRole = currentUser.role;
            currentRoleDisplay.textContent = activeRole;

            // Clear and update role buttons
            document.querySelectorAll('.btn-role').forEach(btn => {
                if (btn.dataset.role === activeRole) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });

            // Update creation permission button and text
            if (activeRole === 'Admin' || activeRole === 'Member') {
                createUrlBtn.disabled = false;
                createUrlBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                createUrlBtn.classList.add('bg-green-600', 'hover:bg-green-700', 'text-white');
                createPermissionText.textContent = `As an ${activeRole}, you are permitted to create new short URLs.`;
            } else { // SuperAdmin
                createUrlBtn.disabled = true;
                createUrlBtn.classList.remove('bg-green-600', 'hover:bg-green-700', 'text-white');
                createUrlBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                createPermissionText.textContent = `As a ${activeRole}, you are restricted from creating short URLs.`;
            }

            // Filter data and render table
            urlTableBody.innerHTML = '';
            let filteredData = [];
            let visibilityDescription = '';

            if (activeRole === 'Member') {
                filteredData = mockData.filter(item => item.user_id === currentUser.id);
                visibilityDescription = 'As a Member, you can only see the short URLs you personally created.';
            } else if (activeRole === 'Admin') {
                filteredData = mockData.filter(item => item.company_id === currentUser.company_id);
                visibilityDescription =
                    'As an Admin, you can see all short URLs created by any user within your company (Innovate Inc.).';
            } else { // SuperAdmin
                filteredData = mockData;
                visibilityDescription =
                    'As a SuperAdmin, you have global visibility and can see all short URLs from all companies.';
            }

            visibilityText.textContent = visibilityDescription;

            if (filteredData.length === 0) {
                urlTableBody.innerHTML =
                    `<tr><td colspan="4" class="text-center py-6 text-gray-500">No short URLs to display for this role's visibility.</td></tr>`;
            } else {
                filteredData.forEach(item => {
                    const row = `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 truncate" style="max-width: 20rem;" title="${item.original_url}">${item.original_url}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-mono">/${item.short_code}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.user_name}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.company_name}</td>
                        </tr>
                    `;
                    urlTableBody.innerHTML += row;
                });
            }
        }

        roleSelector.addEventListener('click', (e) => {
            if (e.target.tagName === 'BUTTON') {
                const selectedRole = e.target.dataset.role;
                currentUser.role = selectedRole;

                // Simulate switching user context for different roles
                if (selectedRole === 'Admin') {
                    currentUser.id = 3;
                    currentUser.company_id = 1;
                } else if (selectedRole === 'SuperAdmin') {
                    currentUser.id = 4;
                    currentUser.company_id = 99; // Not part of a standard company
                } else { // Member
                    currentUser.id = 1;
                    currentUser.company_id = 1;
                }

                render();
            }
        });

        // Initial render
        render();
    </script>
</body>

</html>
