<div class="sidebar">
            
            <div class="sidebar-header">
                <img src="https://ui-avatars.com/api/?name=User&background=random" alt="User Avatar" class="user-avatar">
                <h2>Welcome Back!</h2>
            </div>
            
            <ul class="nav-menu">
            <li class="nav-item">
                    <a href="{% url 'dashboard' %}" class="nav-link" data-target="dashboard">
                    <i class="fa-solid fa-user"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{% url 'order_info' %}" class="nav-link" data-target="orders">
                        <i class="fas fa-shopping-bag"></i> My Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{% url 'edit_profile' %}" class="nav-link" data-target="profile">
                        <i class="fas fa-user-edit"></i> Edit Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{% url 'change_password' %}" class="nav-link" data-target="password">
                        <i class="fas fa-key"></i> Change Password
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{% url 'logout' %}" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Log out
                    </a>
                </li>
            </ul>
        </div>