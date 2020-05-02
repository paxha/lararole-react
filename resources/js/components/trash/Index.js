import React from 'react';
import {Breadcrumb, Layout} from "antd";
import {HomeOutlined} from '@ant-design/icons';
import {Link} from "react-router-dom";

const {Content} = Layout;

function Index() {
    return (
        <div>
            <Breadcrumb style={{margin: '16px 0'}}>
                <Breadcrumb.Item>
                    <Link to="/">
                        <HomeOutlined/> Home
                    </Link>
                </Breadcrumb.Item>
            </Breadcrumb>
            <Content className="site-layout-background" style={{
                padding: 24,
                margin: 0,
                minHeight: 280,
            }}>
                Trash Coming Soon
            </Content>
        </div>
    );
}

export default Index;
