import React, {useState} from 'react';
import {Link} from "react-router-dom";
import {Layout, Menu} from "antd";
import {DeleteOutlined, DeploymentUnitOutlined, HomeOutlined, TeamOutlined} from '@ant-design/icons';

const {Sider} = Layout;

function Sidebar() {
    const [collapsed, setCollapsed] = useState(false);

    function onCollapse() {
        setCollapsed(!collapsed);
    }

    return (
        <Sider theme="light" collapsible collapsed={collapsed} onCollapse={onCollapse}>
            <div className="logo"/>
            <Menu defaultSelectedKeys={[window.location.pathname.split('/')[1] || 'home']} mode="inline">
                <Menu.Item key="home">
                    <Link to='/' replace>
                        <HomeOutlined/>
                        <span>Home</span>
                    </Link>
                </Menu.Item>
                <Menu.Item key="module">
                    <Link to='/module' replace>
                        <DeploymentUnitOutlined/>
                        <span>Module</span>
                    </Link>
                </Menu.Item>
                <Menu.Item key="role">
                    <Link to='/role' replace>
                        <TeamOutlined/>
                        <span>Role</span>
                    </Link>
                </Menu.Item>
                <Menu.Item key="trash">
                    <Link to='/trash' replace>
                        <DeleteOutlined/>
                        <span>Trash</span>
                    </Link>
                </Menu.Item>
            </Menu>
        </Sider>
    );
}

export default Sidebar;
