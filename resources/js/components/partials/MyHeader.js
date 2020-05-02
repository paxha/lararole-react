import React from 'react';
import {Layout, Menu} from "antd";
import {Link} from "react-router-dom";

const {Header} = Layout;

function MyHeader() {
    return (
        <Header className="site-layout-background" style={{padding: 0}}>
            <Menu theme="light" mode="horizontal" defaultSelectedKeys={[window.location.pathname.split('/')[1]]}>
                <Menu.Item key="docs">
                    <Link to="/docs">Docs</Link>
                </Menu.Item>
            </Menu>
        </Header>
    );
}

export default MyHeader;
